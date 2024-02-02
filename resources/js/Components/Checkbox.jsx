import React from 'react';

const Checkbox = ({ label, checked, onChange, className = '' }) => {
  return (
    <label className={`flex items-center ${className}`}>
      <input
        type="checkbox"
        checked={checked}
        onChange={onChange}
        className="form-checkbox h-5 w-5 text-indigo-600"
      />
      <span className="ml-2">{label}</span>
    </label>
  );
};

export default Checkbox;
