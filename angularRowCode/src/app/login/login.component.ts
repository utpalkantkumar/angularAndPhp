import { Component, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import { Validators, FormGroup, FormBuilder } from '@angular/forms';
import { CustomvalidationService } from '../services/customvalidation.service';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { ConfigService} from '../config.service';
import {Observable} from "rxjs/Observable";
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
loginForm: FormGroup;
submitted = false;
  formMsg:any;
//APP_URL = 'http://localhost/CeXWeBuy/app/';
  constructor(
    private fb: FormBuilder,
    private customValidator: CustomvalidationService,
	private http: HttpClient,
	private router: Router,
	private configService:ConfigService
  ) { }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required]]
    }
    );
  }
httpErrorHandler(error: HttpErrorResponse){
      
      return Observable.throw(error.message || "Server error")
  }
 
get loginFormControl() {
    return this.loginForm.controls;
  }
  onSubmit() {
    this.formMsg = "";//rest form msg
	this.submitted = true;
    if (this.loginForm.valid) {
      //alert('Form Submitted succesfully!!!\n Check the values in browser console.');
      console.table(this.loginForm.value);
	  //send form data to server
	  this.http.post(
	         this.configService.APP_URL+'user/login', 
	          JSON.stringify({
				  'email':this.loginForm.value.email,
				  'password':this.loginForm.value.password,
				  
				  }))

     .catch(this.httpErrorHandler)    
    .subscribe((data: any)=>
           {
            if(data.status){
				  this.formMsg=data.msg;
               //redirect to profile page
			   console.log(data.id)
			   this.router.navigate(['/user/profile',data.id]);
			   
            }else{
                  this.formMsg=data.msg;
                } 
              
              
          },
        error=>{
             
               this.formMsg=error
        }
       
      
    )
	  
	  
    }
  }

}
