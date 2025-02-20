import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {
  products: any[] = [];

  constructor(private http: HttpClient) {}

  ngOnInit() {
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
