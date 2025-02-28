import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { HomeComponent } from './components/home/home.component';
import { AppRoutingModule } from './app-routing.module';
import { AboutComponent } from './components/about/about.component';
import { HttpClientModule } from '@angular/common/http';
import { CateDmComponent  } from './components/cate-dm/cate-dm.component';
import { ProductListComponent } from './components/product-list/product-list.component';
import { ProductDetailComponent } from './components/product-detail/product-detail.component';
import { NewsComponent } from './components/news/news.component';



@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    CateDmComponent,
    FooterComponent,
    HomeComponent,
    ProductDetailComponent,
    AboutComponent,
    NewsComponent,
     ProductListComponent,
          NewsComponent,
         
 
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule ,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
