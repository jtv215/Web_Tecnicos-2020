import { UsersService } from './services/users.service';
import { Component, OnInit, ɵConsole } from '@angular/core';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'webTecnicos';

    constructor( public userService: UsersService){

    }
  ngOnInit(){
    this.userService.getEmail()
    .subscribe(
      email => console.log(email),
      err => console.log(err)
    )
  }

}
