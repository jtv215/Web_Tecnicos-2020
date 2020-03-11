import { ToastrService } from 'ngx-toastr';
import { AddEmpresaComponent } from './../add-empresa/add-empresa.component';
import { FormularioComponent } from './../formulario/formulario.component';
import { Router } from '@angular/router';
import { EmpresaService } from './../../services/empresa.service';
import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { MatTableDataSource, MatSort, MatPaginator, MatDialog, MatDialogConfig } from '@angular/material';
/*tabla:
https://www.youtube.com/watch?v=ZL0d3M3uoRQ
https://github.com/CodAffection/Angular-Material-Popup-Dialog-Model
*/
@Component({
  selector: 'app-list-empresa',
  templateUrl: './list-empresa.component.html',
  styleUrls: ['./list-empresa.component.css']
})
export class ListEmpresaComponent implements OnInit {

  datos: string[];
  @Input() dataFiltro: string[]; ngOnChanges(changes: any) {
    this.cargarDataFiltro(this.dataFiltro);
  }

  constructor(
    private empresaService: EmpresaService,
    private route: Router,
    private dialog: MatDialog,
    private toastrService: ToastrService,

  ) {
   }

  listData: MatTableDataSource<any>;
  displayedColumns: string[] = ['idEmpresa', 'provincia', 'nombreEmpresa', 'especialidad', 'contratado', 'actions'];
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  searchKey: string;
  code: string;

  ngOnInit() {
    this.paginator._intl.itemsPerPageLabel = 'Por página.';
    this.cargarTablaWithService();
  }

  cargarTablaWithService() {
    this.empresaService.getEmpresaDatosMin().subscribe(
      result => {
        this.datos = result['data']
        this.rellenarTabla(this.datos)
      });
  }

  rellenarTabla(datos) {
    this.listData = new MatTableDataSource(datos);
    this.listData.sort = this.sort;
    this.listData.paginator = this.paginator;
    this.listData.filterPredicate = (data, filter) => {
      return this.displayedColumns.some(ele => {
        return ele != 'actions' && data[ele].toLowerCase().indexOf(filter) != -1;
      });
    };
  }

  cargarDataFiltro(dataFiltro) {
    this.rellenarTabla(dataFiltro);
  }
  showSuccess(){
    setTimeout(() => {
      this.toastrService.success('Éxito','Se ha eliminado correctamente');
    });
  }

  onSearchClear() {
    this.searchKey = "";
    this.applyFilter();
  }

  applyFilter() {
    this.listData.filter = this.searchKey.trim().toLowerCase();
  }

  onDelete(id) {


    if (confirm('¿Estas seguro de eliminar?')) {
      this.empresaService.deleteEmpresa(id).subscribe(
        result => {
          this.code = result.body['code'];

          if (this.code == '200') {
            this.cargarTablaWithService()
            this.toastrService.success('Exito', 'Se ha añadido correctamente');

          } else {
            alert("Error al borrar mensaje");
          }
        }
      );
    }
  }

  onCreate() {
    const dialogConfig = new MatDialogConfig();
    dialogConfig.disableClose = false;
    dialogConfig.autoFocus = true;
    dialogConfig.width = "70%";
    this.dialog.open(AddEmpresaComponent,dialogConfig);
    
  }



  onEdit(row) {
    this.route.navigate(['/empresa/' + row['idEmpresa']]);
  }

}