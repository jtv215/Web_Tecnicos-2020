import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router, Params } from '@angular/router';
import { EmpresaService } from './../../services/empresa.service';
import { Telefono } from './../../models/telefono';
import { Component, OnInit, Input, Inject } from '@angular/core';
import {
  MAT_DIALOG_DATA
} from "@angular/material/dialog";


@Component({
  selector: 'app-add-telefono',
  templateUrl: './add-telefono.component.html',
  styleUrls: ['./add-telefono.component.css']
})
export class AddTelefonoComponent implements OnInit {
  code: string;
  telefono:Telefono;
  id: string;


  @Input() idEmpresa: string;
  constructor(  
      private empresaService: EmpresaService,
      private route: ActivatedRoute,
      private router: Router,
      @Inject(MAT_DIALOG_DATA) public idEmpresas: any,
      private toastrservice: ToastrService,
    ) { 
      this.telefono= new Telefono("","", "", "");
      this.telefono['idEmpresa'] = idEmpresas;
      this.id = idEmpresas;

    }

  ngOnInit() {
   
  }


  onSubmit() {
  
      this.empresaService.addTelefono(this.telefono).subscribe(
        result => {
          this.code = result.body['code'];
          if (this.code == '200') {
            this.empresaService.subject$.next();
            this.toastrservice.success('Exito', 'Se ha añadido el telefono correctamente');

            
          //  console.log(result.body['data'])
  
          } else {
            alert("Error al añadir telefono");
            //console.log(result.body['data'])
  
          }
  
        });
      
    }




    
}
