import { GLOBAL } from './global';
import { Router } from '@angular/router';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

const httpOptions = {
  observe: 'response' as 'response',
  headers: new HttpHeaders({
    'Content-Type': 'text/plain',
  })
};

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  public url: string;

  constructor(
    public http: HttpClient,
    private router: Router) { this.url = GLOBAL.url; }


  login(user) {
    return this.http.post(this.url + 'login', user, httpOptions)
  }

  loggedIn() {
    //devuelve true si contiene token o falso
    return !!localStorage.getItem('token');
  }

  registrarse(user) {
    return this.http.post(this.url + 'usuario', user, httpOptions)
  };
  getUser(token) {
    return this.http.get<any>(this.url + 'login', token);
  };



  getToken() {
    return localStorage.getItem('token');
  }

  getEmail() {
    return localStorage.getItem('email');
  }

  outSesion() {
    localStorage.removeItem('token');
    localStorage.removeItem('id');
    localStorage.removeItem('email');

    this.router.navigate(['/inicio']);
  }
}
