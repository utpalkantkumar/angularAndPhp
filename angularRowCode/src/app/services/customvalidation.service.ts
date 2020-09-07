import { Injectable } from '@angular/core';
import { ValidatorFn, AbstractControl } from '@angular/forms';
import { FormGroup } from '@angular/forms';
@Injectable({
  providedIn: 'root'
})
export class CustomvalidationService {
APP_URL = 'http://localhost/CeXWeBuy/app/';
  constructor() { }
  passwordValidator(): ValidatorFn {
    return (control: AbstractControl): { [key: string]: any } => {
      if (!control.value) {
        return null;
      }
      const regex = new RegExp('^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$');
      const valid = regex.test(control.value);
      return valid ? null : { invalidPassword: true };
    };
  }
  onlyAlphabetValidator(): ValidatorFn {
    return (control: AbstractControl): { [key: string]: any } => {
      if (!control.value) {
        return null;
      }
      const regex = new RegExp('^[a-z\s]+$');
      const valid = regex.test(control.value);
      return valid ? null : { invalidalphabet: true };
    };
  }
  mobileNumberValidator(): ValidatorFn {
    return (control: AbstractControl): { [key: string]: any } => {
      if (!control.value) {
        return null;
      }
      const regex = new RegExp('^[6-9]{1}[0-9]{9}$');
      const valid = regex.test(control.value);
      return valid ? null : { invalidMobile: true };
    };
  }

}
