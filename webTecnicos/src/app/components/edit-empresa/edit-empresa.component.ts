import { ToastrService } from 'ngx-toastr';
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
  id: string;
  constructor(
    private empresaService: EmpresaService,
    private toastrservice: ToastrService,
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
            console.log(this.empresa);
            this.id = this.empresa['idEmpresa'];

          }

        },
        error => {
          console.log(<any>error);
        }
      )

    });

  }


  onSubmit() {
    this.updateData();
    this.router.navigate(['/empresa/' + this.id]);
  }


  updateData() {

    this.empresaService.updateEmpresa(this.empresa).subscribe(
      result => {
        this.code = result.body['code'];
       // console.log(this.code);

        // tambien recibes un 404 porque no se ha cambiado nada
        this.toastrservice.success('Éxito','Se ha actualizado correctamente');

      });

  }

  onBack(){

    this.router.navigate(['/empresa/'+this.id]);

  }


}