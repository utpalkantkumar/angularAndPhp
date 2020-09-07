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
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

   registerForm: FormGroup;
  submitted = false;
  formError:any;
//APP_URL = 'http://localhost/CeXWeBuy/app/';
  constructor(
    private fb: FormBuilder,
    private customValidator: CustomvalidationService,
	private http: HttpClient,
	private router: Router,
	private configService:ConfigService
  ) { }

  ngOnInit() {
    this.registerForm = this.fb.group({
      name: ['', Validators.compose([
	                        Validators.required,
							Validators.maxLength(10),
							this.customValidator.onlyAlphabetValidator()
							])],
      email: ['', [Validators.required, Validators.email]],
      contact: ['', Validators.compose([
	                    Validators.required,
						this.customValidator.mobileNumberValidator()
						])],
      password: ['', Validators.compose([
	                    Validators.required, 
						this.customValidator.passwordValidator()
						])]
    }
    );
  }
httpErrorHandler(error: HttpErrorResponse){
      
      return Observable.throw(error.message || "Server error")
  }
  get registerFormControl() {
    return this.registerForm.controls;
  }

  onSubmit() {
    this.submitted = true;
	this.formError="";
    if (this.registerForm.valid) {
      //alert('Form Submitted succesfully!!!\n Check the values in browser console.');
      console.table(this.registerForm.value);
	  //send form data to server
	  this.http.post(
	         this.configService.APP_URL+'user/register', 
	          JSON.stringify({
				  'userName':this.registerForm.value.name,
				  'email':this.registerForm.value.email,
				  'contact':this.registerForm.value.contact,
				  'password':this.registerForm.value.password,
				  
				  }))

     .catch(this.httpErrorHandler)    
    .subscribe((data:any)=>
           {
			    
                 
             
               if(data.status){
				   this.formError="Data saved";
                // this.router.navigate(['/user/login']);
				//rest form
				alert('data saved');
				this.registerForm.reset();
				
               
            }else{
                  this.formError=data.msg;  
                } 
              
              
          },
        error=>{
             
               this.formError=error
        }
       
      
    )
	  
	  
    }
  }

}
