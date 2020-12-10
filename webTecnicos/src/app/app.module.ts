import { CopyClipboardModule } from './services/copy-clipboard.module';
import { MaterialModule } from './material/material.module';
import { AuthGuard } from './services/auth.guard';
import { TokenInterceptorService } from './services/token-interceptor.service';

import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
//componentes
import { SignupComponent } from './components/signup/signup.component';
import { SigninComponent } from './components/signin/signin.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { HomeComponent } from './components/home/home.component';
//import
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { PrincipalComponent } from './components/principal/principal.component';
import { FormularioComponent } from './components/formulario/formulario.component';
import { ListEmpresaComponent } from './components/list-empresa/list-empresa.component';
import { DetailEmpresaComponent } from './components/detail-empresa/detail-empresa.component';
import { MensajeListComponent } from './components/mensaje-list/mensaje-list.component';
import { MensajeComponent } from './components/mensaje/mensaje.component';

import { ToastrModule } from 'ngx-toastr';
import { AddEmpresaComponent } from './components/add-empresa/add-empresa.component';
import { EditEmpresaComponent } from './components/edit-empresa/edit-empresa.component';
import { AddTelefonoComponent } from './components/add-telefono/add-telefono.component';


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    NavbarComponent,
    SigninComponent,
    SignupComponent,
    PrincipalComponent,
    FormularioComponent,
    ListEmpresaComponent,
    DetailEmpresaComponent,
    MensajeListComponent,
    MensajeComponent,
    AddEmpresaComponent,
    EditEmpresaComponent,
    AddTelefonoComponent,
  ],
  imports: [
    BrowserModule,AppRoutingModule,
    MaterialModule,// componentes de angular material
    FormsModule,
    HttpClientModule,//servicios http
    BrowserAnimationsModule,
    ReactiveFormsModule,
    CopyClipboardModule,
    ToastrModule.forRoot({
      timeOut: 10000,
      positionClass: 'toast-bottom-right',
      preventDuplicates: true,
    }),
  ],
  providers: [ AuthGuard,
    { provide: HTTP_INTERCEPTORS, useClass: TokenInterceptorService, multi: true }],
  bootstrap: [AppComponent],
  entryComponents:[AddEmpresaComponent, AddTelefonoComponent]
})
export class AppModule { }
