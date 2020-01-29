from unicodedata import normalize


def imprime(lista):
    contador = 0
    for i in lista:
        contador += 1
        print(str(contador) + " " + str(i))


def quitarRepetido(lista):
    lista_nueva = []
    for i in lista:
        if i not in lista_nueva:
            lista_nueva.append(i)

    return lista_nueva


def quitartilde(cadena):
    trans_tab = dict.fromkeys(map(ord, u'\u0301\u0308'), None)  # quitar tildes
    cadena = normalize('NFKC', normalize('NFKD', cadena).translate(trans_tab))

    return cadena
