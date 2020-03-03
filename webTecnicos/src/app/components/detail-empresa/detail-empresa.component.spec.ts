import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailEmpresaComponent } from './detail-empresa.component';

describe('DetailEmpresaComponent', () => {
  let component: DetailEmpresaComponent;
  let fixture: ComponentFixture<DetailEmpresaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailEmpresaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailEmpresaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
