from selenium import webdriver

# pip install webdriver-manager
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.action_chains import ActionChains
import time
import lista

def abreSelenium(url):

    driver = webdriver.Chrome(ChromeDriverManager().install())
    driver.get(url)

    nombreEmpresa = driver.find_element_by_tag_name("h1").text
    # print (nombreEmpresa)

  
    # botón aceptar politicas
    driver.find_element_by_xpath(
        '//*[@id="layer_cookie"]/div/div[2]/div[1]').click()
    # botón contactar
    driver.find_element_by_xpath(
        '//*[@id="main-content"]/div[2]/div[2]/ul/li[1]/span').click()

    iframe = driver.find_element_by_id('boxf')
    driver.switch_to_frame(iframe)

    nombreTecnico = driver.find_element_by_xpath(
        '/html/body/fieldset/ul/li[1]/a[1]/b').text
    print(nombreTecnico)

    localidad = driver.find_element_by_xpath(
        '/html/body/fieldset/ul/li[2]/strong').text
    # print(localidad)

    # obtener provincia -> "Almería (Almería)"
    principio = localidad.find("(")
    final = localidad.find(")")
    provincia = localidad[principio+1: final]
    provincia = lista.quitartilde(provincia).upper()
    print(provincia)

    # obtener localidad -> "Almería (Almería2)"
    localidad = localidad[0: principio]
    localidad = lista.quitartilde(localidad).upper()
    print(localidad)

    # obtener telefono" -> "950651922, 631123133"
    telefono = driver.find_element_by_xpath(
        '/html/body/fieldset/ul/li[3]/strong').text
    telefono = telefono.split(",")
    telefono = telefono[0]
    sizeTelefono = len(telefono)

    
    print(telefono)

    driver.close()

    data = {
        'provincia': provincia,
        'nombreEmpresa': nombreEmpresa,
        'nombreTecnico': nombreTecnico,      
        'localidad': localidad,
        'telefono': telefono
    }

    return data

