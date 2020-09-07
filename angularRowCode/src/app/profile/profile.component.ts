
import { Component, OnInit } from '@angular/core';
import { Validators, FormGroup, FormBuilder } from '@angular/forms';
import { Routes,Router, RouterModule,ActivatedRoute } from '@angular/router';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { ConfigService} from '../config.service';
import {Observable} from "rxjs/Observable";
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';
@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {
id:any;
//APP_URL = 'http://localhost/CeXWeBuy/app/';
//set variable
name:any;
email:any;
contact:any;
  profileStatus:boolean = false;;
  constructor(
  private route: ActivatedRoute
  ,private http: HttpClient,
	private configService:ConfigService
	) { }
httpErrorHandler(error: HttpErrorResponse){
      
      return Observable.throw(error.message || "Server error")
  }
  ngOnInit(): void {
	
	  this.route.paramMap.subscribe(params => {
			this.id = params.get("id");
			console.log(this.id);
		  })
		  /* 
		  
		   this.route.params.subscribe(params => {
          this.assessment_supplier_id=params['id']; 
          this.actiontype = params['type'];
          
       }); */
	   
	   //get data from DB
	   this.http.get(this.configService.APP_URL+'user/profile/'+this.id)

			 .catch(this.httpErrorHandler)    
			.subscribe((data: any)=>
				   {
					   console.log(data.data);
					if(data.status){
						this.profileStatus=true;
						  this.name=data.data.username;
						  this.email=data.data.email;
						  this.contact=data.data.contact;
					   
					}else{
						alert('no data');
						this.profileStatus=false;
						  
						} 
					  
					  
				  },
				error=>{
					 
					   this.profileStatus=false;
				}
			   
			  
			)
	   
	   
	   
  }

}
