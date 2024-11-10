"use client";
import { useRouter } from "next/navigation";
import Image from "next/image";

type Props = {
  id: number;
  name: string;
  description: string;
  image: string;
};

export function RecipeBox(data: Props) {
  const router = useRouter();
  return (
    <div className="recipe-box w-[14rem] h-[19.8rem]">
      <div className="card bg-base-100">
        <figure className="px-3 mt-2 h-[150px] w-[225px]">
          <Image
            className="rounded-xl object-cover"
            src={`http://127.0.0.1:8000/api/image/${data?.image}`}
            alt="Shoes"
            height={120}
            width={200}
          />
        </figure>
        <div className="recipe-details items-center">
          <div className="recipe-name">{data.name}</div>

          <div className="recipe-desc">{data.description}</div>
          <div className="text-center">
            <button
              className="recipe-btn w-full"
              onClick={() => router.push(`/details/${data?.id}`)}
            >
              Show Recipe
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
