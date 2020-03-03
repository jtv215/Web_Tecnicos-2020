import { GLOBAL } from './global';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

const httpOptions = {
  observe: 'response' as 'response',
};
@Injectable({
  providedIn: 'root'
})
export class MensajeService {
  public url: string;

  constructor(
    public http: HttpClient,
    private router: Router
  ) {
    this.url = GLOBAL.url;
  }

  getPrueba() {
    return "Probando servicio mensaje";
  }

  getAllMensaje(id) {
    return this.http.get(this.url + 'mensaje/'+id);
  }

  addMensaje(datos) {
    return this.http.post<any>(this.url + 'mensaje', datos, httpOptions);
  }

  deleteMensaje(id) {
    return this.http.delete<any>(this.url + 'mensaje/'+id);
  }

}
