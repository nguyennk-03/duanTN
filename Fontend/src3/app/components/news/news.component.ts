import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

interface News {
  id: number;
  title: string;
  content: string;
  image: string;
}

@Component({
  selector: 'app-news',
  templateUrl: './news.component.html',
  styleUrls: ['./news.component.css']
})
export class NewsComponent implements OnInit {
  newsList: News[] = [];
  selectedNews: News | null = null;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.fetchNews();
  }

  fetchNews() {
    this.http.get<News[]>('assets/data/news.json').subscribe(
      data => {
        this.newsList = data;
      },
      error => {
        console.error('Lỗi khi tải dữ liệu tin tức:', error);
      }
    );
  }


  viewDetails(news: News) {
    this.selectedNews = news;
  }
}