import { GLOBAL } from './global';
import { Router } from '@angular/router';
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
export class MensajeService {
  public url: string;

  constructor(
    public http: HttpClient) {
    this.url = GLOBAL.url;
  }

  getPrueba() {
    return "Probando servicio mensaje";
  }

  getAllMensaje(id) {
    return this.http.get(this.url + 'mensaje/' + id);
  }

  addMensaje(datos) {
    return this.http.post(this.url + 'mensaje', datos, httpOptions);
  }

  deleteMensaje(id) {
    let aid= {"idMensaje": id}  
    return this.http.post(this.url + 'delete/mensaje',aid, httpOptions );
  }

}
