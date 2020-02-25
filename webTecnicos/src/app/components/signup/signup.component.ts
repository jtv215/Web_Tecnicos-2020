import { Router } from '@angular/router';
import { AuthService } from './../../services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css'],
  providers: [AuthService] //
})
export class SignupComponent implements OnInit {
  //se añade los campos de forma automatica, y no hace falta poner nada, ya esta ng...
  user = {}
  mostrar=false;
  status='';
  //importar servicio y pasar por el contrucor para instancear y poder usarlo
  constructor(
    private authService: AuthService,
    private route: Router) { }

  ngOnInit() {
  }

  activarError(status){    
    if(status=='ERROR'){
      this.mostrar=true;
    }else{
      this.mostrar=false;
    }
  }

  signUp() {
    this.authService.registrarse(this.user)
      .subscribe(
        result => {
          //console.log(result)     
          this.activarError(result['status'])

          
        },
        err => {
          var errorMensaje = <any>err;
          console.log(errorMensaje)
        }
      )

  }

}
