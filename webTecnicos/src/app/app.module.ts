import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
	
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeroesComponent } from './heroes/heroes.component';
import { MenuComponent } from './menu/menu.component';
import { ToolbarComponent } from './toolbar/toolbar.component';
import { EmployeeComponent } from './employees/employee/employee.component';
import { EmployeeListComponent } from './employees/employee-list/employee-list.component';
import {materialModule} from './material.module';


@NgModule({
  declarations: [
    AppComponent,
    HeroesComponent,
    MenuComponent,
    ToolbarComponent,
    EmployeeComponent,
    EmployeeListComponent,
    
  
    
    
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    materialModule
    
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
