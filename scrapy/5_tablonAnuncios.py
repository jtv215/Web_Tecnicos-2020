import urllib
from urllib.request import urlopen
from bs4 import BeautifulSoup
import requests
import json
from unicodedata import normalize
import diccionario
import re
import lista  #pip install selenium
import seleniumTablonAnuncios

def getSoup(url):
    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")
    return soup


def getProvincia(soup):
    provincia = soup.select('.pagination ol li a')[2]
    print(provincia.text)
    return provincia.text


def getListaPaginas(soup):

    pagination = soup.findChildren('ul',{'class': 'pagination text-center'})
    soup = pagination

    #busco etiqueta a
    for link in soup:
        link = link.select('li a')
        # print (link)

    pagination = link
    n_item = len(pagination)
    # print (n_item)
    del(pagination[n_item-1])  # borro el ultimo porque se repite enlace
    startURL = "https://www.tablondeanuncios.com"

    listaPaginas = []
    for link in pagination:
        url = startURL+link.get('href')
        listaPaginas.append(url)
        # print(url)

    return listaPaginas


def getURLEmpresas(url):

    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")

    #Buscar etiqueta cercana a a
    etiquetaH3 = soup.select('h3')    
    # print(etiquetaH3)

    #añado link
    listaEmpresa = []
    startURL = "https://www.tablondeanuncios.com"
    cont = 0
    for link in etiquetaH3:
        cont+=1
        link = link.find('a').get('href') 
        link = startURL+link
        listaEmpresa.append(link)
        #print(str(cont) + " "+link)   

    return listaEmpresa



def getDatos(url):
    html = urllib.request.urlopen(url)
    soup = BeautifulSoup(html, "lxml")

    especificacion = soup.find('p', {'style': 'font-size:15px;'}).text.strip()
    # print (especificacion)           
    
    dataSele = seleniumTablonAnuncios.abreSelenium(url)

    data = {
        'provincia': dataSele['provincia'],
        'nombreEmpresa': dataSele['nombreEmpresa'],
        'nombreTecnico': dataSele['nombreTecnico'],
        'especialidad': 'Electrodomésticos',
        'direccion': '',
        'email': '',
        'web': '',
        'horario': '',
        'especificacion': especificacion,
        'contratado': 'no',
        'repetido': 'no',
        'webFound': url,
        'interesado': '',
        'comentario': '',
        'ocultar': 'no',
        'localidad':  dataSele['localidad'],
        'telefono':  dataSele['telefono']
    }
    return data    
    # return 0

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
        # print('nombreTecnico:', empresa['nombreTecnico'])
        print('especialidad:', empresa['especialidad'])
        print('direccion:', empresa['direccion'])
        print('email:', empresa['email'])
        print('web:', empresa['web'])
        # print('horario:', empresa['horario'])
        print('especificacion:', empresa['especificacion'])
        # print('contratado:', empresa['contratado'])
        # print('repetido:', empresa['repetido'])
        print('webFound:', empresa['webFound'])
        # print('interesado:', empresa['interesado'])
        # print('comentario:', empresa['comentario'])
        # print('ocultar:', empresa['ocultar'])
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

    url = "https://www.tablondeanuncios.com/anuncios-en-almeria/reparacion-de-electrodomestico.htm"
    soup = getSoup(url)

    # # PASO 1 Obtiene url hojas
    listaPaginas = getListaPaginas(soup)
    listaPaginas.insert(0, url)
    # lista.imprime(listaPaginas)

    # # PASO 2 Obtienes url empresas "comentar"
    # listaURLEmpresas = getURLEmpresas(listaPaginas[0])
    # listaURLEmpresas = getURLEmpresas("https://www.tablondeanuncios.com/reparacion-electrodomesticos/servicio_tecnico_otsein_carboneras_950651922-3469680.htm")
    # lista.imprime(listaURLEmpresas)

    # # PASO 2.1 comprobar --> datos de las empresas  "hay que comentar"
    # url =  "https://www.tablondeanuncios.com/reparacion-electrodomesticos/almeria_reparaciones-1926790.htm"
    # data = getDatos(url)
    # lista.mostrarJSON(data)

    
    cont = 0
    contadorEmpresasQuieres = 10
    listaFinalDatos = []
    salirBucle = False

    # PASO 3 Recorre las paginas y las empresas
    for urlPagina in listaPaginas:
        listaEmpresas = getURLEmpresas(urlPagina)
        for urlEmpresa in listaEmpresas:
            cont += 1
            print(str(cont)+" "+ urlEmpresa)
            datosEmpresa = getDatos(urlEmpresa)
            mostrarDatos(datosEmpresa,cont)

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
    


if __name__ == '__main__':
    main()
