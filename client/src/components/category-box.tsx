import React from "react";

type Props = {
  icon: React.ElementType;
  name: string;
  items: number;
};

export function CategoryBox({ icon: Icon, name, items }: Props) {
  return (
    <div className="category-box">
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
