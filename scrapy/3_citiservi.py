import urllib
from urllib.request import urlopen
from bs4 import BeautifulSoup
import requests
import json
from unicodedata import normalize
import diccionario
import re


def getSoup(url):
    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")
    return soup


def getProvincia(soup):
    provincia = soup.select('.pagination ol li a')[2]
    print(provincia.text)
    return provincia.text


def getListaPaginas(soup):
    pagination = soup.select('.pagination ul li a')
    #print (pagination)
    n_item = len(pagination)
    #print (n_item)
    del(pagination[n_item-1])  # borro el ultimo porque se repite enlace
    # """"
    listaPaginas = []
    for link in pagination:
        listaPaginas.append(link.get('href'))
        # print(link.get('href'))
    # """
    return listaPaginas


def getURLEmpresas(url):

    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")
    cont = 0
    listaURL = []

    for link in soup.select('h4 a'):
        enlace = link.get('href')
        cont += 1
        listaURL.append(enlace)
        #print(str(cont) + " " + enlace)

    return listaURL


def muestraListaURL(listaURL):
    cont = 0
    for enlace in listaURL:
        cont += 1
        print(str(cont) + " " + enlace)


def getDatos(url):
    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")

    fProvincia = soup.find('span', {'itemprop': 'addressRegion'}).text
    # print(fProvincia)
    trans_tab = dict.fromkeys(map(ord, u'\u0301\u0308'), None)  # quitar tildes
    provincia = normalize('NFKC', normalize(
        'NFKD', fProvincia).translate(trans_tab))
    provincia = provincia.upper()
    # print(provincia)

    fNombre = soup.find('span', {'itemprop': 'name'}).text
    nombreEmpresa = fNombre
    # print(fNombre)

    nombreTecnico = ''
    # print(nombreTecnico)

    especialidad = 'Electrodomésticos'
    # print(especialidad)

    direccion = soup.find(
        'li', {'itemtype': 'https://schema.org/PostalAddress'})
    direccion1 = direccion.find('span', {'itemprop': 'streetAddress'}).text
    direccion2 = direccion.find('span', {'itemprop': 'postalCode'}).text
    direccion3 = direccion.find('span', {'itemprop': 'addressLocality'}).text
    direccion4 = direccion.find('span', {'itemprop': 'addressRegion'}).text
    direccion = direccion1 + " " + direccion2 + " " + \
        direccion3 + " " + "(" + direccion4 + ")"
    #print (direccion)

    email = ''
    #print (email)

    fweb = ''

    if not soup.find('a', {'itemprop': 'url'}):
        fweb = ''
    else:
        fweb = soup.find('a', {'itemprop': 'url'})
        fweb = fweb.get('href')

    web = fweb
    print(web)

    horario = ''
    print(horario)
    
    especificacion = soup.find('a', {'itemprop': 'description'}).text
    #print (especificacion)

    contratado = 'no'
    #print (contratado)

    repetido = 'no'
    #print (repetido)

    webFound = url
    #print (webFound)

    interesado = ''
    #print (interesado)

    comentario = ''
    #print (comentario)

    ocultar = 'no'
    #print (ocultar)

    localidad = soup.find('span', {'itemprop': 'addressLocality'}).text
    trans_tab = dict.fromkeys(map(ord, u'\u0301\u0308'), None)  # quitar tildes
    localidad = normalize('NFKC', normalize(
        'NFKD', localidad).translate(trans_tab)).upper().replace(",", "")
    #print (localidad)

    telefono = soup.find('span', {'itemprop': 'telephone'}).text
    #print (telefono)

    data = {
        'provincia': provincia,
        'nombreEmpresa': nombreEmpresa,
        'nombreTecnico': nombreTecnico,
        'especialidad': especialidad,
        'direccion': direccion,
        'email': email,
        'web': web,
        'horario': horario,
        'especificacion': especificacion,
        'contratado': contratado,
        'repetido': repetido,
        'webFound': webFound,
        'interesado': interesado,
        'comentario': comentario,
        'ocultar': ocultar,
        'localidad': localidad,
        'telefono': telefono
    }
    return data


def mostrarDatos(data, cont):
    print(str(cont) + '**********************')
    print('provincia:', data['provincia'])
    print('nombreEmpresa:', data['nombreEmpresa'])
    print('nombreTecnico:', data['nombreTecnico'])
    print('especialidad:', data['especialidad'])
    print('direccion:', data['direccion'])
    print('email:', data['email'])
    print('web:', data['web'])
    print('horario:', data['horario'])
    print('especificacion:', data['especificacion'])
    print('contratado:', data['contratado'])
    print('repetido:', data['repetido'])
    print('webFound:', data['webFound'])
    print('interesado:', data['interesado'])
    print('comentario:', data['comentario'])
    print('ocultar:', data['ocultar'])
    print('localidad:', data['localidad'])
    print('telefono:', data['telefono'])
    print('')


def mostrarArray(ArrayEmpresas):
    cont = 0
    for empresa in ArrayEmpresas:
        cont += 1
        print(str(cont) + '~~**********************')
        print('nombreEmpresa:', empresa['nombreEmpresa'])
        #print('nombreTecnico:', empresa['nombreTecnico'])
        print('especialidad:', empresa['especialidad'])
        print('direccion:', empresa['direccion'])
        print('email:', empresa['email'])
        print('web:', empresa['web'])
        #print('horario:', empresa['horario'])
        print('especificacion:', empresa['especificacion'])
        #print('contratado:', empresa['contratado'])
        #print('repetido:', empresa['repetido'])
        print('webFound:', empresa['webFound'])
        #print('interesado:', empresa['interesado'])
        #print('comentario:', empresa['comentario'])
        #print('ocultar:', empresa['ocultar'])
        print('provincia:', empresa['provincia'])
        print('localidad:', empresa['localidad'])
        print('telefono:', empresa['telefono'])
        print('')


def addData(empresa):
    uri = "http://localhost/tecnicos/api/index.php/empresa"
    response = requests.post(uri, empresa)
    response = response.json()

    return response


def addListaEmpresa(listaEmpresa):
    cont = 0
    cont2 = 0
    cont3 = 0
    for empresa in listaEmpresa:
        response = addData(empresa)
        if response['data'] == 'Se ha añadido la empresa correctamente':
            cont += 1
        if response['data'] == 'Se ha añadido correctamente la localidad o el telefono':
            cont2 += 1
        if response['status'] == 'Error':
            cont3 += 1

    print("--------------Resultados----------------")
    print("El número total de empresas recopiladas son: " + str(len(listaEmpresa)))
    print("Empresas Nuevas que se han añadido son: " + str(cont))
    print("Empresas que se han repetido, pero solo se añaden pueblos y telefonos son: " + str(cont2))
    print("No se han añadido a la base de datos: " + str(cont3))


def compruebaExisteDiccionario(cadena):
    comprueba = False
    cadena = cadena.lower()
    trans_tab = dict.fromkeys(map(ord, u'\u0301\u0308'), None)  # quitar tildes
    cadena = normalize('NFKC', normalize('NFKD', cadena).translate(trans_tab))
    # print(cadena)

    listaDicc = diccionario.getDiccionario()

    for palabra in listaDicc:
        aux = cadena.find(palabra)
        if aux < 0:
            comprueba = False
            # print(comprueba)
        else:
            comprueba = True
            # print(comprueba)
            break

    return comprueba


def main():

    url = "https://www.citiservi.es/buscar?q=reparar+electrodomesticos+almeria&mode=1"
    soup = getSoup(url)

    # PASO 1 Obtiene url hojas
    listaPaginas = getListaPaginas(soup)
    listaPaginas.insert(0, url)
    # muestraListaURL(listaPaginas)

    # PASO 2 Obtienes url empresas
    #listaURLEmpresas = getURLEmpresas(listaPaginas[0])
    # muestraListaURL(listaURLEmpresas)

    # PASO 2.1 comprobar datos de las empresas
    # hay que comentar
    #url =  "https://www.citiservi.es/almeria/servicio-tecnico-balay-air-almeria-664836045-almeria__10149220_24.html"
    # getDatos(url)
    # mostrarDatos(datosEmpresa,cont)

    # """
    cont = 0
    contadorEmpresasQuieres = 2
    listaFinalDatos = []
    salirBucle = False

    # PASO 3 Recorre las hojas y las empresas
    for urlPagina in listaPaginas:
        listaEmpresas = getURLEmpresas(urlPagina)
        for urlEmpresa in listaEmpresas:
            cont += 1
            #print(str(cont)+" "+ urlEmpresa)
            datosEmpresa = getDatos(urlEmpresa)
            # mostrarDatos(datosEmpresa,cont)

            comprueba = compruebaExisteDiccionario(
                datosEmpresa['especificacion'])

            if comprueba == False:  # No esta en el diccionario, asi que añade
                listaFinalDatos.append(datosEmpresa)

            if cont == contadorEmpresasQuieres:
                salirBucle = True
                break
        if salirBucle:
            break

    # Paso 4 añadir base de datos
    mostrarArray(listaFinalDatos)
    print("¿Desea guardar los datos? (s o n)")
    respuesta = input()
    if respuesta != 's':
        print("El codigo se ha parado")
    else:
        print('Los datos se estan guardado correctamente en la base de datos')
        addListaEmpresa(listaFinalDatos)
    # """


if __name__ == '__main__':
    main()
