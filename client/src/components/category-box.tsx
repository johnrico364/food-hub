import React from "react";

type Props = {
  icon: React.ElementType;
  name: string;
  items: number;
  isActive: boolean;
};

export function CategoryBox({ icon: Icon, name, items, isActive }: Props) {
  return (
    <div className={isActive ? "category-box-active":"category-box"}>
      <div className="mt-1">
        <Icon className="icons" />
      </div>
      <div className="mt-4">
        <div className="name">{name}</div>
        <div className="items">{items}</div>
      </div>
    </div>
  );
}
