
import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-cate-dm',
  templateUrl: './cate-dm.component.html',
  styleUrls: ['./cate-dm.component.css']
})
export class CateDmComponent {
  categories: any[] = [];

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.http.get<any>('assets/categories.json').subscribe(data => {
      this.categories = data.categories;
    });
  }
}
