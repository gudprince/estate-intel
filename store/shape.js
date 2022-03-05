import json from '../shapes.json';
const state = () => {
  return {
    shapes: json,
		shapeNames: [],
		shapeColors: [],
		shapeLength: 0,
		allShapes: [
			{name: 'Oval' ,value: 'oval'},
			{name: 'Round' ,value: 'circle'},
			{name: 'Triangle' ,value: 'triangle'},
			{name: 'Square' ,value: 'square'},
			{name: 'Rectangle' ,value: 'rectangle'},
		],
		allColors: [
			'red',
			'blue',
			'green',
			'yellow',
			'sky_blue',
			'gray'
		]    
  };
};

const getters = {
	fiteredShapes(state){
		let temShapes = state.shapes
		if(state.shapeNames.length > 0){
			temShapes = temShapes.filter((item)=>{
				return state.shapeNames.includes(item.name)
			})
		}
		if(state.shapeColors.length > 0){
			temShapes = temShapes.filter((item)=>{
				return state.shapeColors.includes(item.color)
			})
		}
		return temShapes;
	},
	title(state){
		let title = '';
		if(state.shapes.length === state.fiteredShapes.length){
			title =  'All items'
		}
		if(state.allColors.length == state.shapeColors.length && 
			(state.shapeNames.length > 1 && state.shapeNames.length < state.allShapes.length)  ||
			state.allShapes.length == state.shapeNames.length && 
			(state.shapeColors.length > 1 && state.shapeColors.length < state.allColors.length)){
			title =  'Multiple items'
		}
		if(state.allShapes.length == state.shapeNames.length && state.shapeColors.length == 1){
			let color = state.shapeColors[0];
			title = `All ${color} items`
		}
		if(state.allColors.length == state.shapeColors.length && state.shapeNames.length == 1){
			let shape = state.shapeNames[0];
			title = `All ${shape} items`
		}
		if(	(state.shapeNames.length > 1 && state.shapeNames.length < state.allShapes.length)  &&
			state.shapeColors.length == 1){
			let color = state.shapeColors[0];
			title = `Multiple ${color} items`
		}
		if(	(state.shapeColors.length > 1 && state.shapeColors.length < state.allColors.length)  &&
			state.shapeNames.length == 1){
			let name = state.shapeNames[0];
			title = `Multiple ${name} items`
		}
		if(state.shapeColors.length == 1 && state.shapeNames.length ==1){
			let name = state.shapeNames[0];
			title = `${name} item`
		}
		if(	(state.shapeColors.length > 1 && state.shapeColors.length < state.allColors.length)  &&
			(state.shapeNames.length > 1 && state.shapeNames.length < state.allShapes.length)){
			let name = state.shapeNames[0];
			title = `Multiple items`
		}
		if(state.shapeColors.length == 1 && state.shapeNames.length == 0){
			let color = state.shapeColors[0];
			title = `All ${color} items`
		}
		if(state.shapeNames.length == 1 && state.shapeColors.length == 0){
			let name = state.shapeNames[0];
			title = `All ${name} items`
		}
		if((state.shapeNames.length > 1 && state.shapeNames.length < state.allShapes.length) == 1 && state.shapeColors.length == 0){
			title = `Multiple shape items`
		}
		if((state.shapeColors.length > 1 && state.shapeColors.length < state.allColors.length) == 1 && state.shapeNames.length == 0){
			title = `Multiple color items`
		}
	
	
	
		return title
	}
}

const mutations = {
	selectShape(state,shape){
		let index = state.shapeNames.indexOf(shape);
		if(index === -1){
			state.shapeNames.push(shape);
		}
		else{
			state.shapeNames.splice(index,1);  
		}
	},
	selectColor(state, color){
		let index = state.shapeColors.indexOf(color);
		if(index === -1){
			state.shapeColors.push(color);
		}
		else{
			state.shapeColors.splice(index,1);  
		}
	},
	logout(){
		this.$cookies.remove('isLogin')
		this.$router.push('/');
	}
};