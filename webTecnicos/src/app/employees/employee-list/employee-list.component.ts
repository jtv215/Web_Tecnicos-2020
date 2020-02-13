import { Component, OnInit } from '@angular/core';
import {Empleado} from './empleado';

@Component({
  selector: 'app-employee-list',
  templateUrl: './employee-list.component.html',
  styleUrls: ['./employee-list.component.css']
})
export class EmployeeListComponent implements OnInit {
  public trabajadores: Array<Empleado>;

  constructor() { 

    this.trabajadores = [
      new Empleado('David',45,'cocinero',true),
      new Empleado('jefferson',45,'ingeniero',true),
      new Empleado('ana',23,'camarera',true)

  ];
  }

  ngOnInit() {
    console.log(this.trabajadores);
  }

}
