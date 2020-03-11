import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddTelefonoComponent } from './add-telefono.component';

describe('AddTelefonoComponent', () => {
  let component: AddTelefonoComponent;
  let fixture: ComponentFixture<AddTelefonoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddTelefonoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddTelefonoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
