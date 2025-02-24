import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './register.component.html',
  styleUrls: ['../../../assets/assets-admin/css/bootstrap.min.css']
})
export class RegisterComponent {
    username : string="";
    email : string="";
    password : string="";
    repassword : string="";

    isEmailValid(email: string): boolean {
      const re = /\S+@\S+\.\S+/;
      return re.test(email);
    }
    isPasswordValid(password: string): boolean {
    const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
    return re.test(password);
    }

    async onSubmit(): Promise<void> {
      if(!this.email || !this.username || !this.password || !this.repassword){
      return
      }
      if(!this.isEmailValid(this.email)){
        return
      }
      if(!this.isPasswordValid(this.password)){
        return
      }
      if(this.password!==this.repassword){
        return
      }

      const user = {
      username: this.username,
      email: this.email,
      password: this.password,
      role : "user"
      }
      console.log(user);
      const url ='https://backend-production-7f27.up.railway.app/api/users';
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
      };
      try{
        const response = await fetch(url, options);
        const data = await response.json();
        console.log('Đã đăng ký thành công');
      }catch(error){
        console.log('Đăng ký thất bại',error);
      }

    }

}
