import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { AuthService } from './../../services/auth.service';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css'],
  providers: [AuthService] //
})
export class SignupComponent implements OnInit {
  user = {
    'email': '',
    'password': ''
  }
  mostrar = false;
  code: string;
  message: string;

  //importar servicio y pasar por el contrucor para instancear y poder usarlo
  constructor(
    private toastrService: ToastrService,
    private authService: AuthService,
    private route: Router) { }

  ngOnInit() {
  }

  signUp() {
    this.authService.registrarse(this.user)
      .subscribe(
        result => {
          this.code = result.body['code'];
          //console.log(result.body['code'])
          if (this.code == '200') {
            this.toastrService.success('Éxito','Se ha registrado correctamente');

            this.message = "Se ha registrado correctamente";
            this.mostrar = true;
          } else {
            this.message = "El correo ya existe*";
            this.mostrar = true;
          }
        })
  }

}
