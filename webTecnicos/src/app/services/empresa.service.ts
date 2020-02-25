import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

const httpOptions = {
  observe: 'response' as 'response',
};

@Injectable({
  providedIn: 'root'
})
export class EmpresaService {
  public url: string;

  constructor(
    public http: HttpClient,
    private router: Router
  ) {
    this.url = 'http://localhost:80/tecnicos/api/index.php/';
  }

  getPrueba() {
    return "Probando servicio Empresa";
  }

  getEmpresa() {
    return this.http.get(this.url + 'empresa');
  }

  getEmpresdatosMin() {
    return this.http.get(this.url + 'empresa/datosmin');
  }

  getProvincia() {
    return this.http.get(this.url + 'empresa/provincia');
  }

  getEmpresaFiltro(filtro) {
    return this.http.post<any>(this.url + 'empresa/filtro', filtro, httpOptions);
  }

}