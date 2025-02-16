import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './components/home/home.component';
import { AboutComponent } from './components/about/about.component';
import { CateDmComponent } from './components/cate-dm/cate-dm.component';
import { ProductDetailComponent } from './components/product-detail/product-detail.component';
const routes: Routes = [
  { path: '', component: HomeComponent},
  { path: 'about', component: AboutComponent},
  { path: 'list', component: CateDmComponent},
  { path: 'detail-product', component: ProductDetailComponent}
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule] //
})
export class AppRoutingModule { }
