import { AuthService } from './auth.service';
import { HttpInterceptor } from '@angular/common/http';
import { Injectable } from '@angular/core';


@Injectable({
  providedIn: 'root'
})
export class TokenInterceptorService implements HttpInterceptor {
constructor(
  private authService: AuthService
  ){}

  //Intercepta la petición y añade una cabecera token
  intercept(req, next){
    const tokenizeReq =req.clone({
      setHeader:{
        //Authorization: this.authService.getToken()
      }
    })
    return next.handle(tokenizeReq)
  }

}
