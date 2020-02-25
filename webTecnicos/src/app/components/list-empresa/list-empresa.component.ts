import { EmpresaService } from './../../services/empresa.service';
import { Component, OnInit, ViewChild, Input } from '@angular/core';
import { MatTableDataSource, MatSort, MatPaginator } from '@angular/material';

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
  ) { }

  listData: MatTableDataSource<any>;
  displayedColumns: string[] = ['idEmpresa', 'provincia', 'nombreEmpresa', 'especialidad', 'contratado', 'actions'];
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatPaginator) paginator: MatPaginator;
  searchKey: string;

  ngOnInit() {
    this.paginator._intl.itemsPerPageLabel = 'Por página.';
    this.cargarTablaWithService();
  }

  cargarTablaWithService() {
    this.empresaService.getEmpresdatosMin().subscribe(
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

  onSearchClear() {
    this.searchKey = "";
    this.applyFilter();
  }

  applyFilter() {
    this.listData.filter = this.searchKey.trim().toLowerCase();
  }

  onDelete($key) {
    if (confirm('Are you sure to delete this record ?')) {
      //this.service.deleteEmployee($key);
      // this.notificationService.warn('! Deleted successfully');
    }
  }
  /*
    onCreate() {
      this.service.initializeFormGroup();
      const dialogConfig = new MatDialogConfig();
      dialogConfig.disableClose = true;
      dialogConfig.autoFocus = true;
      dialogConfig.width = "60%";
      this.dialog.open(EmployeeComponent,dialogConfig);
    }
    */

  /*
  onEdit(row){
    this.service.populateForm(row);
    const dialogConfig = new MatDialogConfig();
    dialogConfig.disableClose = true;
    dialogConfig.autoFocus = true;
    dialogConfig.width = "60%";
    this.dialog.open(EmployeeComponent,dialogConfig);
  }
  */
}