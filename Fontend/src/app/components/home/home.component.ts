import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  products: any[] = [];

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.loadProducts();
  }

  loadProducts() {
    this.http.get<any>('assets/data/products.json').subscribe({
      next: (data) => {
        this.products = data.product; // Gán dữ liệu vào biến products
        console.log('Dữ liệu sản phẩm:', this.products); // Kiểm tra dữ liệu trong console
      },
      error: (err) => console.error('Lỗi khi tải dữ liệu sản phẩm:', err)
    });
  }
}
