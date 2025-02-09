import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CateDmComponent } from './cate-dm.component';

describe('CateDmComponent', () => {
  let component: CateDmComponent;
  let fixture: ComponentFixture<CateDmComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CateDmComponent]
    });
    fixture = TestBed.createComponent(CateDmComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
