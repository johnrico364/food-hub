type Props = {
  params: {
    country_name: string;
  };
};

export default function Country({ params }: Props) {
  return (
    <div className="text-2xl">
      Hello Country
      <div className="text-4xl">Hello, {params.country_name}</div>
    </div>
  );
}
