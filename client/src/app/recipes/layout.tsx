/* eslint-disable @typescript-eslint/no-require-imports */
"use client";
import Image from "next/image";
import Link from "next/link";
import React, { useState } from "react";

// icons
import { PiHouseLight } from "react-icons/pi";
import { BiWorld } from "react-icons/bi";
import { usePathname } from "next/navigation";

type Props = {
  children: React.ReactNode;
};

const country = ["Philippines", "USA"];

export default function RecipesLayout({ children }: Props) {
  const pathname = usePathname();
  const [showCountries, set_showCountries] = useState(false);

  return (
    <div className="recipes-layout-section">
      <div className="wrapper">
        <div className="nav-side">
          <div className="wrapper justify-center mt-10">
            <Image
              src={require("@/images/utils/logo.png")}
              height={27}
              alt="logo"
            />
          </div>

          <div className="wrapper justify-center mt-12">
            <Link
              href={"/recipes"}
              className={
                pathname === '/recipes' ? "nav-link-active" : "nav-link"
              }
            >
              <span className="pb-1">
                <PiHouseLight className="nav-icons home" />
              </span>
              Home
            </Link>

            <div
              className={
                pathname.startsWith('/recipes/country') ? "nav-link-active" : "nav-link"
              }
              onClick={() => set_showCountries(!showCountries)}
            >
              <span>
                <BiWorld className="nav-icons country" />
              </span>
              Country
            </div>
            <ul className={showCountries ? "pl-3 cursor-pointer" : "hidden"}>
              {country.map((c) => {
                return (
                  <li key={c}>
                    <Link href={`/recipes/country/${c.toLowerCase()}`}>
                      {c}
                    </Link>
                  </li>
                );
              })}
            </ul>
          </div>
        </div>
        <div className="content-side overflow-auto">{children}</div>
      </div>
    </div>
  );
}
