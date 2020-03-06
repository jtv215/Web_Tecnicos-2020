import { EmpresaService } from './../../services/empresa.service';
import { EmpresaFiltro } from './../../models/empresaFiltro';
import { Component, OnInit, Input } from '@angular/core';
export interface Food {
  value: string;
  viewValue: string;
}
@Component({
  selector: 'app-formulario',
  templateUrl: './formulario.component.html',
  styleUrls: ['./formulario.component.css']
})

export class FormularioComponent implements OnInit {

  empresaFiltro: EmpresaFiltro;
  provincias: string[] = [];
  especialidades: string[] = ['Electrodomésticos', 'funeraria'];
  contratado: string[] = ['Si', 'No'];
  @Input() data: string[];

  constructor(private empresaService: EmpresaService) {
    //Create object for form, Y esos valores se pondrán por valores por defecto en el filtro
    this.empresaFiltro = new EmpresaFiltro("ALMERIA", "Electrodomésticos", "No");
  }

  ngOnInit() {
    this.rellenarBoxProvincia();
  }

  rellenarBoxProvincia() {
    this.empresaService.getProvincia().subscribe(
      result => {
        this.provincias = result['data'];
      })
  }

  onSubmit() {
    //console.log(this.empresaFiltro);
    this.empresaService.getEmpresaFiltro(this.empresaFiltro).subscribe(
      result => {
        //console.log(result.body);
        if(result.body['status']== "ERROR"){
          //console.log(result.body['status']);
          this.data = [];
        }else{
          this.data = result.body['data']
        }
        
      })
  }

}
