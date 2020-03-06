import { formatDate } from '@angular/common';
import { ActivatedRoute, Params } from '@angular/router';
import { Mensaje } from './../../models/mensaje';
import { MensajeService } from './../../services/mensaje.service';
import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
//para el cargar componente hijo
import { Subject } from "rxjs";

@Component({
  selector: 'app-mensaje-list',
  templateUrl: './mensaje-list.component.html',
  styleUrls: ['./mensaje-list.component.css']
})
export class MensajeListComponent implements OnInit {

  state: Subject<boolean> = new Subject<boolean>();
  comentario: string;
  mensaje: Mensaje;
  id: string;

  constructor(
    private mensajeService: MensajeService,
    private route: ActivatedRoute,

  ) { }

  ngOnInit() {
    this.getIdParams();
  }

  onSubmit(idFormulario: NgForm) {
    this.addMensajeService();
    this.state.next(true);
    idFormulario.reset();
  }

  
//**************** function************************/

  getIdParams() {
    this.route.params.forEach((params: Params) => {
      this.id = params['id'];
      // console.log(this.id)
    });
  }

  addMensajeService() {
    let email = localStorage.getItem('email');
    let myDate = formatDate(new Date(), 'yyyy-MM-dd hh:mm:ss ', 'en');
    this.mensaje = new Mensaje(this.id, myDate, this.comentario, email);

    this.mensajeService.addMensaje(this.mensaje).subscribe(
      result => {
        let data = result['body'];
        if (data['code'] == 200) {
         
        // console.log("eee")
        
          } else {
            console.log(result.body)
            alert("Error al añadir mensaje");
          }
//       
      },
      error => {
        console.log(<any>error)
      }
    );
  }

  resetFormulario(idFormulario: NgForm) {
    if (idFormulario != null) {
      idFormulario.reset();
    }
  }


}
