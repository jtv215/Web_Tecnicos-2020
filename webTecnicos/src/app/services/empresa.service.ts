import { Subject, Observable } from 'rxjs';
import { GLOBAL } from './global';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

const httpOptions = {
  observe: 'response' as 'response',
  headers: new HttpHeaders({
    'Content-Type': 'text/plain',
  })
};

@Injectable({
  providedIn: 'root'
})
export class EmpresaService {
  public url: string;
  public subject$ = new Subject<void>();

  constructor(
    public http: HttpClient ) {
    this.url = GLOBAL.url;
  }

  getPrueba() {
    return "Probando servicio Empresa";
  }

  get refreshEmpresa$(){
    return this.subject$;
  }

  getEmpresa(id) {
    return this.http.get(this.url + 'empresa/'+id);
  }

  getEmpresaDatosMin() {
    return this.http.get(this.url + 'empresa/datosmin');
  }

  getProvincia() {
    return this.http.get(this.url + 'empresa/provincia');
  }

  getEmpresaFiltro(filtro) {
    return this.http.post(this.url + 'empresa/filtro', filtro, httpOptions);
  }

  deleteEmpresa(id) {
    let aid= {"id": id};
    return this.http.post(this.url + 'delete/empresa',aid,httpOptions);
  }

  addEmpresa(empresa) {
    return this.http.post(this.url + 'empresa', empresa, httpOptions);
  }

  updateEmpresa(empresa) {
    return this.http.post(this.url + 'actualizarEmpresa', empresa, httpOptions);
  }

  addTelefono(telefono):Observable<any> {
    return (this.http.post(this.url + 'telefono', telefono, httpOptions));
  }

  deleteTelefono(telefono) {
    return this.http.post(this.url + 'delete/telefono', telefono, httpOptions);
  }



}