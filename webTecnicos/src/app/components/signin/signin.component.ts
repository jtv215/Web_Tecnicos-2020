import { HttpHeaders, HttpResponse } from '@angular/common/http';
import { Router } from '@angular/router';
import { AuthService } from './../../services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.css']
})
export class SigninComponent implements OnInit {

  user = {
    'email': '',
    'password': ''
  }

  mostrar = false;
  status = '';

  constructor(
    private authService: AuthService,
    private route: Router
  ) { }

  ngOnInit() {
  }

  activarError(status) {

    if (status == 'ERROR') {
      this.mostrar = true;
    } else {
      this.mostrar = false;
    }
  }

  signin() {
    this.authService.login(this.user)
      .subscribe(

        result => {
          //console.log(result.body)
          //console.log(result.headers.get('Authorization'));       
          if (result.body['status'] == 'Success') {

            localStorage.setItem('token', result.headers.get('Authorization'));
            localStorage.setItem('id', result.body['data']['id']);
            localStorage.setItem('email', result.body['data']['email']);

            this.route.navigate(['/principal'])

          } else {
            this.activarError(result.body['status'])
          }

        },
        error => {
          console.log(<any>error)
        }
      )






  }
}
