import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';  
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule,ReactiveFormsModule  } from '@angular/forms';
import { AppRoutingModule,routingComponent } from './app-routing.module';
import { HttpClientModule, HttpClient } from '@angular/common/http';

import { AppComponent } from './app.component';
import { CustomvalidationService} from './services/customvalidation.service';
import { ConfigService} from './config.service';

@NgModule({
  declarations: [
    AppComponent,
    routingComponent
  ],
  imports: [
  CommonModule,
    BrowserModule,
    AppRoutingModule,
	FormsModule,
	ReactiveFormsModule,
	HttpClientModule
  ],
  providers: [CustomvalidationService,ConfigService],
  bootstrap: [AppComponent]
})
export class AppModule { }

