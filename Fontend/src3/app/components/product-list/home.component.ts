import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-home',
  imports: [CommonModule],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent implements OnInit {



  categories: any[] = [];
  apiUrl: string = 'https://backend-production-7f27.up.railway.app/api/v1/categories';
  products: any[] = [];
  baseImageUrl = 'https://backend-production-7f27.up.railway.app/';
  apiUrlPro: string = 'https://backend-production-7f27.up.railway.app/api/v1/products';


  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.loadCategories();
    this.loadProducts();
  }

  loadCategories() {
    this.http.get<any[]>(this.apiUrl).subscribe({
      next: (data) => {
        console.log("Dữ liệu API trả về:", data);
        this.categories = data.map((category: any) => ({
          id: category.id,
          name: category.name || "Không có tên",
          description: category.description || "Không có mô tả",
          image: category.image || 'assets/images/default-category.jpg'
        })).slice(0, 3);

      },
      error: (err) => console.error("Lỗi khi tải dữ liệu danh mục:", err)
    });
  }
  loadProducts() {
    this.http.get<any[]>(this.apiUrlPro).subscribe({
      next: (products) => {
        console.log("Dữ liệu API trả về:", products);
        this.products = products.map((product: any) => ({
          id: product.id,
          name: product.name,
          description: product.description || "Không có mô tả",
          price: Number(product.price) || 0,
          image: product.image_url ? this.baseImageUrl + product.image_url : '',
          category: product.category?.name || "Không có danh mục"
        })).slice(0, 8);
      },
      error: (err) => console.error("Lỗi khi tải dữ liệu sản phẩm:", err)
    });
  }
}
