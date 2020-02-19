import { Router } from '@angular/router';
import { Injectable, ErrorHandler } from '@angular/core';

//HTTP
import { HttpClient } from '@angular/common/http';
//import 'rxjs/add/operator/catch';//npm install --save rxjs-compat
const httpOptions = {
  observe: 'response' as 'response',
};

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private url = 'http://localhost:80/tecnicos/api/index.php/';

  constructor(
    public http: HttpClient,
    private router: Router
  ) { }

  registrarse(user) {
    return this.http.post<any>(this.url + 'usuario', user)
  };

  login(user) {
    return this.http.post<any>(this.url + 'login', user, httpOptions);
  };

  getUser(token) {
    return this.http.get<any>(this.url + 'login', token);
  };

  loggedIn() {
    //devuelve true si contiene token o falso
    return !!localStorage.getItem('token');
  }

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
