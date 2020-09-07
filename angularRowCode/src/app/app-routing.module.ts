import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { ProfileComponent } from './profile/profile.component'

const routes: Routes = [
{ path: '',pathMatch: 'full', redirectTo: 'user/register' },
{ path: 'user/login',pathMatch: 'full', component: LoginComponent },
{ path: 'user/register',pathMatch: 'full', component: RegisterComponent },
{ path: 'user/profile/:id',pathMatch: 'full', component: ProfileComponent },
{ path: '**', redirectTo: 'user/register' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
export const routingComponent=[LoginComponent,RegisterComponent]