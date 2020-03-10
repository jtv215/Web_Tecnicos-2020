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
    private dialog: MatDialog
  ) {

  }

  ngOnInit() {
    this.getEmpresa()

  }
  onEdit() {
    this.route.params.forEach((params: Params) => {
      let id = params['id'];
      this.router.navigate(['/editempresa/' + id]);
    });

  }

  getEmpresa() {
    //recogemos el parametro del id
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






  /*public notify(event: string): void {
    let message = `'${event}' has been copied to clipboard`
    console.log(message);
  }*/

  public stamp(copy): string {

    // console.log(copy);  
    return copy;
  }




}
