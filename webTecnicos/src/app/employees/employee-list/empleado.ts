import { StringMap } from '@angular/compiler/src/compiler_facade_interface';

export class Empleado{
    /*
public nombre:string;
public edad:number;

constructor(nombre,edad){
    this.nombre= nombre;
    this.edad= edad;
}
*/

constructor(
public nombre:string,
public edad:number,
public cargo:string,
public contratado:boolean
){}


}