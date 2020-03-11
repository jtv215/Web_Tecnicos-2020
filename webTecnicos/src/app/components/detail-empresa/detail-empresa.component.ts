import { ToastrService } from 'ngx-toastr';
import { AddTelefonoComponent } from './../add-telefono/add-telefono.component';
import { EditEmpresaComponent } from './../edit-empresa/edit-empresa.component';
import { MatDialogConfig, MatDialog } from '@angular/material';
import { Telefono } from './../../models/telefono';
import { Empresa, } from './../../models/Empresa';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { EmpresaService } from './../../services/empresa.service';
import { Component, OnInit, Input } from '@angular/core';
//import { ClipboardService } from 'ngx-clipboard'

@Component({
  selector: 'app-detail-empresa',
  templateUrl: './detail-empresa.component.html',
  styleUrls: ['./detail-empresa.component.css']
})
export class DetailEmpresaComponent implements OnInit {
  empresa: Empresa;
  telefonos: Telefono[];
  

  @Input() public name: string;

  constructor(
    private empresaService: EmpresaService,
    private route: ActivatedRoute,
    private router: Router,
    private dialog: MatDialog,
    private toastrservice:ToastrService,
  ) {

  }

  ngOnInit() {
    this.empresaService.refreshEmpresa$
    .subscribe(() => {
      this.getEmpresa();

    });
    this.getEmpresa();

  }
  onEdit() {
    this.route.params.forEach((params: Params) => {
      let id = params['id'];
      this.router.navigate(['/editempresa/' + id]);
    });

  }

  onCreateTelefono(){
    let idEmpresa;
    this.route.params.forEach((params: Params) => {
      idEmpresa = params['id'];
    });

    const dialogConfig = new MatDialogConfig();
    dialogConfig.disableClose = false;
    dialogConfig.autoFocus = true;
    dialogConfig.width = "70%";
    dialogConfig.data = idEmpresa;
    this.dialog.open(AddTelefonoComponent,dialogConfig);

  }

  getEmpresa() {
    this.route.params.forEach((params: Params) => {
      let id = params['id'];

      this.empresaService.getEmpresa(id).subscribe(
        result => {
          if (result['code'] == 200) {
            this.empresa = result['data'];
            this.telefonos = result['telefono'];
          }

        },
        error => {
          console.log(<any>error);
        }
      )

    });

  }


  onDelete(item) {

    if (confirm('¿Estas seguro de eliminar?')) {
      let id = {'idTelefono':item['idTelefono']}
      this.empresaService.deleteTelefono(id).subscribe(
        result => {
       //console.log(result.body)
       if (result.body['code'] == 200) {
        this.getEmpresa();
        this.toastrservice.success('Éxito','se ha eliminado correctamente');

     
      } else {
        alert("Error al borrar mensaje");
      }
    }
      );
    }
    
  }

  public stamp(copy): string {

    // console.log(copy);  
    return copy;
  }




}
