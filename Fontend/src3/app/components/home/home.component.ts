import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

interface Product {
  id: number;
  name: string;
  slug: string;
  description: string;
  price: number;
  oldPrice?: number; // Thêm thuộc tính này nếu API có cung cấp giá cũ
  category?: string; // Thêm nếu sản phẩm có danh mục
  image: string;
}

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  products: Product[] = [];

  constructor(private http: HttpClient) {}
  categories: any[] = [];
  apiUrl: string = 'https://backend-production-7f27.up.railway.app/api/v1/categories';
  ngOnInit(): void {
    this.loadProducts();
    this.loadCategories();
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
    this.http.get<any>('https://backend-production-7f27.up.railway.app/api/v1/products').subscribe({
      next: (data) => {
        if (data && Array.isArray(data)) {
          this.products = data.map((item: any) => ({
            id: item.id,
            name: item.name,
            slug: item.slug,
            description: item.description,
            price: parseFloat(item.price),
            oldPrice: item.oldPrice ? parseFloat(item.oldPrice) : undefined, // Kiểm tra giá cũ
            category: item.category || 'Không có danh mục', // Kiểm tra danh mục
            image: item.images && item.images.length > 0 ? item.images[0].image_url : 'assets/images/default-product.png'
          })).slice(0, 8); ;
        }
        console.log('Dữ liệu sản phẩm từ API:', this.products);
      },
      error: (err) => console.error('Lỗi khi tải dữ liệu từ API:', err)
    });
  }
  
}
