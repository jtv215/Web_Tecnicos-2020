import { AddTelefonoComponent } from './components/add-telefono/add-telefono.component';
import { EditEmpresaComponent } from './components/edit-empresa/edit-empresa.component';
import { AddEmpresaComponent } from './components/add-empresa/add-empresa.component';
import { DetailEmpresaComponent } from './components/detail-empresa/detail-empresa.component';
import { FormularioComponent } from './components/formulario/formulario.component';
import { CanActivate } from '@angular/router/src/utils/preactivation';
import { AuthGuard } from './services/auth.guard';
import { PrincipalComponent } from './components/principal/principal.component';
import { SignupComponent } from './components/signup/signup.component';
import { SigninComponent } from './components/signin/signin.component';
import { HomeComponent } from './components/home/home.component';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ListEmpresaComponent } from './components/list-empresa/list-empresa.component';

const routes: Routes = [
  { path: '', redirectTo: 'inicio', pathMatch: 'full' }, //pag inicio
  { path: 'inicio', component: HomeComponent },
  { path: 'signup', component: SignupComponent },
  { path: 'signin', component: SigninComponent },
  {
    path: 'principal', component: PrincipalComponent, //pag despues de login
    canActivate: [AuthGuard]
  },
  {
    path: 'listaEmpresa', component: ListEmpresaComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'empresas', component: FormularioComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'empresa/:id', component: DetailEmpresaComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'addempresa', component: AddEmpresaComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'editempresa/:id', component: EditEmpresaComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'addtelefono', component: AddTelefonoComponent,
    canActivate: [AuthGuard]
  },

  
  
  { path: '**', component: HomeComponent }//cuando hay algun fallo



];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
