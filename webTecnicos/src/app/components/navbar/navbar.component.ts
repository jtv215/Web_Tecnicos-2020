import { AuthService } from './../../services/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
 // email=''; 
  constructor(
    public authService: AuthService
   ){}

  ngOnInit() {
   // this.email=this.authService.getEmail();

  }



 
}
