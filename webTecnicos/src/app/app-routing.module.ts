import { CanActivate } from '@angular/router/src/utils/preactivation';
import { AuthGuard } from './services/auth.guard';
import { PrincipalComponent } from './components/principal/principal.component';


import { SignupComponent } from './components/signup/signup.component';
import { SigninComponent } from './components/signin/signin.component';
import { HomeComponent } from './components/home/home.component';
import { AppComponent } from './app.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
  { path: '', redirectTo: 'inicio', pathMatch: 'full' }, //pag inicio
  { path: 'inicio', component: HomeComponent },
  { path: 'signup', component: SignupComponent }, 
  { path: 'signin', component: SigninComponent }, 
  { path: 'principal', component: PrincipalComponent, //pag despues de login
    canActivate: [AuthGuard]}, 
  { path: '**', component: AppComponent }//cuando hay algun fallo
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
