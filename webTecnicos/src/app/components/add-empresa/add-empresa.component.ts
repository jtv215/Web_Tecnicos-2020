import { EmpresaService } from './../../services/empresa.service';
import { Empresa } from './../../models/empresa';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-empresa',
  templateUrl: './add-empresa.component.html',
  styleUrls: ['./add-empresa.component.css']
})
export class AddEmpresaComponent implements OnInit {
  especialidades: string[] = ['Electrodomésticos', 'Funeraria'];
  empresa: Empresa;
  code: string;

  constructor(
    private empresaService: EmpresaService

  ) {
    this.empresa = new Empresa("", "", "", "", "",
      "", "", "", "", "",
      "", "", "", "", "",
      "", "")
  }

  ngOnInit() {
  }


  onSubmit() {
    console.log(this.empresa);

    this.empresaService.addEmpresa(this.empresa).subscribe(
      result => {
        this.code = result.body['code'];
        if (this.code == '200') {
          console.log(result.body['data'])

        } else {
          console.log(result.body['data'])

        }

      })
  }
}
