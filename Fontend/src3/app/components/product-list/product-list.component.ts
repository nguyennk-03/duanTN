import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {
  products: any[] = [];
  filteredProducts: any[] = [];
  apiUrl: string = 'https://backend-production-7f27.up.railway.app/api/v1/products';

  // Chỉ giữ bộ lọc giá
  priceFilter: number = 10000000;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.fetchProducts();
  }

  fetchProducts(): void {
    this.http.get<any[]>(this.apiUrl).subscribe(
      (data) => {
        this.products = data;
        this.applyFilters(); // Áp dụng bộ lọc ngay sau khi lấy dữ liệu
      },
      (error) => {
        console.error('Lỗi khi lấy dữ liệu sản phẩm:', error);
      }
    );
  }

  applyFilters(): void {
    this.filteredProducts = this.products.filter(product => product.price <= this.priceFilter);
  }

  getFilteredProducts(): any[] {
    return this.filteredProducts;
  }
}
