import { Mensaje } from './../../models/mensaje';
import { ActivatedRoute, Params } from '@angular/router';
import { MensajeService } from './../../services/mensaje.service';
import { Component, OnInit, Input } from '@angular/core';
import { formatDate } from '@angular/common';
import { ToastrService  } from 'ngx-toastr';

import { Subject } from "rxjs";
@Component({
  selector: 'app-mensaje',
  templateUrl: './mensaje.component.html',
  styleUrls: ['./mensaje.component.css']
})
export class MensajeComponent implements OnInit {


  mensajeList: Mensaje[];

  @Input() cargarLista: Subject<boolean> = new Subject<boolean>();
  @Input() mensajeAux: Mensaje;
  @Input() id: string;

  constructor(
    private mensajeService: MensajeService,
    private toastr: ToastrService ,
  ) { }


  ngOnInit() {
    this.observableBoton()
    this.loadMensajeListServer();
  }

  onDelete(idMensaje) {
    if (confirm('¿Estas seguro de eliminar?')) {
      this.mensajeService.deleteMensaje(idMensaje).subscribe(
        result => {
       //console.log(result.body['code'])
       if (result.body['code'] == 200) {
       
        this.loadMensaje();
     
      } else {
        alert("Error al borrar mensaje");
      }
    }
      );
    }

  }

  //**************** function************************/


  loadMensajeListServer() {
    this.mensajeService.getAllMensaje(this.id).subscribe(
      result => {
        if (result['code'] == 200) {
          this.mensajeList = result['data'];
        } else {
          this.mensajeList = null;
        }
      }
    );

  }

  observableBoton() {
    this.cargarLista.subscribe(response => {
      if (response) {
        //El setTimeout se hace porque tarda más en añadir a la bd que el GET
        setTimeout(() => {
          this.loadMensajeListServer();
        }, 100);

      }
    });
  }

  loadMensaje() {
    this.mensajeService.getAllMensaje(this.id).subscribe(
      result => {
        if (result['code'] == 200) {
          this.mensajeList = result['data'];
        } else {
          this.mensajeList = null;
        }
      }
    );

  }
}

