import { MatDialogConfig, MatDialog } from '@angular/material';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { EmpresaService } from './../../services/empresa.service';
import { Empresa } from './../../models/empresa';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-edit-empresa',
  templateUrl: './edit-empresa.component.html',
  styleUrls: ['./edit-empresa.component.css']
})
export class EditEmpresaComponent implements OnInit {
  especialidades: string[] = ['Electrodomésticos', 'Funeraria'];
  empresa: Empresa;
  code: string;
  constructor(
    private empresaService: EmpresaService,
    private route: ActivatedRoute,
    private router: Router,
  ) {

  }

  ngOnInit() {
    this.getEmpresa()
  }




  getEmpresa() {
    this.route.params.forEach((params: Params) => {
      let id = params['id'];

      this.empresaService.getEmpresa(id).subscribe(
        result => {
          if (result['code'] == 200) {
            this.empresa = result['data'];
            //this.telefonos = result['telefono'];
          }

        },
        error => {
          console.log(<any>error);
        }
      )

    });

  }


  onSubmit() {

    this.route.params.forEach((params: Params) => {
      let id = params['id'];

      this.updateData();

      this.router.navigate(['/empresa/' + id]);    

    });
  }


  updateData(){
    
    this.empresaService.updateEmpresa(this.empresa).subscribe(
      result => {
        this.code = result.body['code'];
        if (this.code == '200') {
        //  console.log(result.body['data'])

        } else {
          alert("Error al borrar mensaje");
          //console.log(result.body['data'])

        }

      });

  }


}